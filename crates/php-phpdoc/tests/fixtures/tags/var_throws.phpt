===input===
/**
 * @var int $count
 * @throws \RuntimeException When things go wrong
 */
===output===
{
  "summary": null,
  "description": null,
  "tags": [
    {
      "kind": {
        "Var": {
          "ty": {
            "kind": {
              "Named": "int"
            },
            "span": {
              "start": 12,
              "end": 15
            }
          },
          "name": "$count",
          "description": null
        }
      },
      "span": {
        "start": 7,
        "end": 22
      }
    },
    {
      "kind": {
        "Throws": {
          "ty": {
            "kind": {
              "Named": "\\RuntimeException"
            },
            "span": {
              "start": 34,
              "end": 51
            }
          },
          "description": "When things go wrong"
        }
      },
      "span": {
        "start": 26,
        "end": 74
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 76
  }
}
