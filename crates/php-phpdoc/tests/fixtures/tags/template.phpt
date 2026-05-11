===input===
/**
 * @template T of \Countable
 * @template-covariant U
 */
===output===
{
  "summary": null,
  "description": null,
  "tags": [
    {
      "kind": {
        "Template": {
          "name": "T",
          "bound": {
            "kind": {
              "Named": "\\Countable"
            },
            "span": {
              "start": 22,
              "end": 32
            }
          }
        }
      },
      "span": {
        "start": 7,
        "end": 32
      }
    },
    {
      "kind": {
        "TemplateCovariant": {
          "name": "U",
          "bound": null
        }
      },
      "span": {
        "start": 36,
        "end": 59
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 61
  }
}
