===input===
/**
 * @param string $url
 *   See {@link Foo::bar()} for usage.
 */
===output===
{
  "summary": null,
  "description": null,
  "tags": [
    {
      "name": "param",
      "body": {
        "segments": [
          {
            "Text": "string $url\nSee "
          },
          {
            "InlineTag": {
              "name": "link",
              "body": "Foo::bar()",
              "span": {
                "start": 35,
                "end": 53
              }
            }
          },
          {
            "Text": " for usage."
          }
        ],
        "span": {
          "start": 14,
          "end": 64
        }
      },
      "span": {
        "start": 7,
        "end": 66
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 68
  }
}
