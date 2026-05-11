===input===
/**
 * @psalm-type UserId = positive-int
 * @psalm-suppress InvalidReturnType
 * @phpstan-ignore-next-line
 */
===output===
{
  "summary": null,
  "description": null,
  "tags": [
    {
      "name": "psalm-type",
      "body": {
        "segments": [
          {
            "Text": "UserId = positive-int"
          }
        ],
        "span": {
          "start": 19,
          "end": 40
        }
      },
      "span": {
        "start": 7,
        "end": 40
      }
    },
    {
      "name": "psalm-suppress",
      "body": {
        "segments": [
          {
            "Text": "InvalidReturnType"
          }
        ],
        "span": {
          "start": 60,
          "end": 77
        }
      },
      "span": {
        "start": 44,
        "end": 77
      }
    },
    {
      "name": "phpstan-ignore-next-line",
      "body": null,
      "span": {
        "start": 81,
        "end": 108
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 110
  }
}
