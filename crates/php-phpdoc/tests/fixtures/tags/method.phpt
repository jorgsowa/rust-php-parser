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
      "kind": {
        "Method": {
          "is_static": false,
          "return_type": null,
          "name": "foo",
          "params": [],
          "description": null
        }
      },
      "span": {
        "start": 7,
        "end": 20
      }
    },
    {
      "kind": {
        "Method": {
          "is_static": true,
          "return_type": {
            "kind": {
              "Named": "User"
            },
            "span": {
              "start": 39,
              "end": 43
            }
          },
          "name": "create",
          "params": [
            {
              "ty": {
                "kind": {
                  "Named": "string"
                },
                "span": {
                  "start": 51,
                  "end": 57
                }
              },
              "name": "$name",
              "by_ref": false,
              "variadic": false,
              "default": null,
              "span": {
                "start": 51,
                "end": 64
              }
            },
            {
              "ty": {
                "kind": {
                  "Named": "int"
                },
                "span": {
                  "start": 64,
                  "end": 67
                }
              },
              "name": "$age",
              "by_ref": false,
              "variadic": false,
              "default": null,
              "span": {
                "start": 64,
                "end": 74
              }
            }
          ],
          "description": "Create a user"
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
