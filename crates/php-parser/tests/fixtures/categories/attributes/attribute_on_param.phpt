===source===
<?php function f(#[FromQuery] string $name) {}
===errors <=7.4===
expected variable, found end of file
missing closing ')'
expected '{', found end of file
missing closing '}'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file, expecting variable (T_VARIABLE) in Standard input code on line 1
===ast <=7.4===
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
              "name": null,
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 46,
                "end": 46
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
        "end": 17
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 17
  }
}
===ast >=8.0===
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
