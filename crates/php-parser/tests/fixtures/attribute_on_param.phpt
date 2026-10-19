===source===
<?php function f(#[FromQuery] string $name) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [
            {
              "name": {
                "name": "name",
                "span": {
                  "start": 37,
                  "end": 42
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "string"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 30,
                      "end": 36
                    }
                  }
                },
                "span": {
                  "start": 30,
                  "end": 36
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [
                {
                  "name": {
                    "parts": [
                      "FromQuery"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 19,
                      "end": 28
                    }
                  },
                  "args": [],
                  "span": {
                    "start": 19,
                    "end": 28
                  }
                }
              ],
              "span": {
                "start": 17,
                "end": 42
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 46
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46
  }
}
