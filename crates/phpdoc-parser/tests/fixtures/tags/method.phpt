===input===
/**
 * @method foo()
 * @method static User create(string $name, int $age) Create a user
 */
===output===
{
  "summary": null,
  "description": null,
  "tags": [
    {
      "name": "method",
      "body": {
        "segments": [
          {
            "Text": "foo()"
          }
        ],
        "span": {
          "start": 15,
          "end": 20
        }
      },
      "span": {
        "start": 7,
        "end": 20
      }
    },
    {
      "name": "method",
      "body": {
        "segments": [
          {
            "Text": "static User create(string $name, int $age) Create a user"
          }
        ],
        "span": {
          "start": 32,
          "end": 88
        }
      },
      "span": {
        "start": 24,
        "end": 90
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 92
  }
}
