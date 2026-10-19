===source===
<?php
function f(int\X $a, string\Y &$b, float\Z ...$c) {}
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
                "name": "a",
                "span": {
                  "start": 23,
                  "end": 25
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "int",
                      "X"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 17,
                      "end": 22
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 22
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 25
              }
            },
            {
              "name": {
                "name": "b",
                "span": {
                  "start": 37,
                  "end": 39
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "string",
                      "Y"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 27,
                      "end": 35
                    }
                  }
                },
                "span": {
                  "start": 27,
                  "end": 35
                }
              },
              "default": null,
              "by_ref": true,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 27,
                "end": 39
              }
            },
            {
              "name": {
                "name": "c",
                "span": {
                  "start": 52,
                  "end": 54
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "float",
                      "Z"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 41,
                      "end": 48
                    }
                  }
                },
                "span": {
                  "start": 41,
                  "end": 48
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": true,
              "attributes": [],
              "span": {
                "start": 41,
                "end": 54
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
        "end": 58
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 58
  }
}
