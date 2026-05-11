===input===
/**
 * See {@link https://example.com} for details.
 *
 * {@inheritdoc}
 *
 * @param string $url See {@link Foo::bar()} for usage
 */
===output===
{
  "summary": {
    "segments": [
      {
        "Text": "See "
      },
      {
        "InlineTag": {
          "name": "link",
          "body": "https://example.com",
          "span": {
            "start": 11,
            "end": 38
          }
        }
      },
      {
        "Text": " for details."
      }
    ],
    "span": {
      "start": 7,
      "end": 51
    }
  },
  "description": {
    "segments": [
      {
        "InlineTag": {
          "name": "inheritdoc",
          "body": null,
          "span": {
            "start": 58,
            "end": 71
          }
        }
      }
    ],
    "span": {
      "start": 58,
      "end": 71
    }
  },
  "tags": [
    {
      "name": "param",
      "body": {
        "segments": [
          {
            "Text": "string $url See "
          },
          {
            "InlineTag": {
              "name": "link",
              "body": "Foo::bar()",
              "span": {
                "start": 101,
                "end": 119
              }
            }
          },
          {
            "Text": " for usage"
          }
        ],
        "span": {
          "start": 85,
          "end": 129
        }
      },
      "span": {
        "start": 78,
        "end": 131
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 133
  }
}
