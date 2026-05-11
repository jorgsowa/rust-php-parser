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
      "kind": {
        "TypeAlias": {
          "name": "UserId",
          "ty": {
            "kind": {
              "Named": "positive-int"
            },
            "span": {
              "start": 28,
              "end": 40
            }
          }
        }
      },
      "span": {
        "start": 7,
        "end": 40
      }
    },
    {
      "kind": {
        "Suppress": {
          "rules": "InvalidReturnType"
        }
      },
      "span": {
        "start": 44,
        "end": 77
      }
    },
    {
      "kind": {
        "Suppress": {
          "rules": ""
        }
      },
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
