<?php
function loadLiveEntries(): array
{
  $path = __DIR__ . '/data/live.json';
  $contents = file_get_contents($path);
  if ($contents === false) {
    error_log('Unable to read Silentlab live data from ' . $path);
    http_response_code(500);
    exit('Unable to load events.');
  }

  try {
    $data = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
  } catch (JsonException $error) {
    error_log('Unable to decode Silentlab live data: ' . $error->getMessage());
    http_response_code(500);
    exit('Unable to load events.');
  }

  if (!is_array($data) || !isset($data['entries']) || !is_array($data['entries'])) {
    error_log('Silentlab live data has an invalid structure.');
    http_response_code(500);
    exit('Unable to load events.');
  }

  foreach ($data['entries'] as $entry) {
    if (!is_array($entry) || !isset($entry['id'], $entry['date']) ||
      !preg_match('/\A[A-Za-z0-9_-]+\z/', $entry['id']) ||
      !preg_match('/\A\d{2}-\d{2}-\d{4}\z/', $entry['date'])) {
      error_log('Silentlab live data contains an invalid entry.');
      http_response_code(500);
      exit('Unable to load events.');
    }
  }

  return $data['entries'];
}

function liveEntrySortKey(array $entry): string
{
  if (!preg_match('/\A(\d{2})-(\d{2})-(\d{4})\z/', $entry['date'], $matches)) {
    throw new UnexpectedValueException('Event date is invalid.');
  }

  return $matches[3] . $matches[2] . $matches[1] . '_' . $entry['id'];
}
