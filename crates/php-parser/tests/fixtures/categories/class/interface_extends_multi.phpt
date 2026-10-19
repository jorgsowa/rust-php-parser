===source===
<?php interface Foo extends Bar, Baz { public function run(): void; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 16,
              "end": 19
            }
          },
          "extends": [
            {
              "parts": [
                "Bar"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 28,
                "end": 31
              }
            },
            {
              "parts": [
                "Baz"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 33,
                "end": 36
              }
            }
          ],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "run",
                    "span": {
                      "start": 55,
                      "end": 58
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 62,
                          "end": 66
                        }
                      }
                    },
                    "span": {
                      "start": 62,
                      "end": 66
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 39,
                "end": 67
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 69
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 69
  }
}
