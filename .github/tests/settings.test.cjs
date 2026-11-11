const assert = require('node:assert/strict');
const fs = require('node:fs');
const path = require('node:path');
const test = require('node:test');
const vm = require('node:vm');

const source = fs.readFileSync(path.join(__dirname, '..', '..', 'index.js'), 'utf8');
const resetSource = source.match(/function resetSettings\(\) \{[\s\S]*?\n\}/)[0];

test('Reset restores Events to Grid without changing selected events or unrelated queries', () => {
  for (const [current, expected] of [
    ['/events?view=details', '/events'],
    ['/events?view=details&source=test#top', '/events?source=test#top'],
    ['/event?a=23-08-2019_01&view=details', '/event?a=23-08-2019_01&view=details'],
    ['/releases?source=test', '/releases?source=test']
  ]) {
    let cleared = false;
    let destination;
    vm.runInNewContext(`${resetSource}\nresetSettings();`, {
      URL,
      localStorage: { clear() { cleared = true; } },
      window: { location: {
        href: `http://localhost:8007${current}`,
        replace(url) { destination = url; }
      } }
    });
    assert.equal(cleared, true);
    assert.equal(destination, `http://localhost:8007${expected}`);
  }
});
