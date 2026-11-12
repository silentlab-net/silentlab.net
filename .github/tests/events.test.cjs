const assert = require('node:assert/strict');
const test = require('node:test');

const origin = 'http://localhost:8007';

async function get(path) {
  const response = await fetch(origin + path);
  assert.equal(response.status, 200, path);
  return response.text();
}

test('Event pages render consecutively numbered songs without extra labels', async () => {
  const page = await get('/event?a=12-01-2018_01');
  assert.match(page, /<h2>Setlist<\/h2>/);
  assert.match(page, /1\. Twice As Old\n2\. Lonesome Town\n3\. Blister In The Sun/);
  assert.doesNotMatch(page, /Known songs:|Encores:/);
});

test('Events without a known setlist do not show one', async () => {
  const page = await get('/event?a=27-07-2018_01');
  assert.doesNotMatch(page, /<h2>Setlist<\/h2>/);
});

test('Added events appear in both views and use a poster placeholder', async () => {
  for (const id of ['05-05-2018_01', '27-02-2019_01']) {
    const page = await get(`/event?a=${id}`);
    assert.match(page, /class="event-poster-placeholder"/);
    assert.match(page, /<h2>Setlist<\/h2>/);
  }
  for (const route of ['/events', '/events?view=details']) {
    const page = await get(route);
    for (const id of ['05-05-2018_01', '27-02-2019_01']) {
      assert.ok(page.includes(`/event?a=${id}`), `${route}: ${id}`);
    }
    assert.equal((page.match(/class="event-poster-placeholder"/g) || []).length, 2);
  }
});
