===source===
<?php
function h(#[SensitiveParameter, SensitiveParameter] $a) {}
===errors <=7.4===
expected variable, found end of file
===errors >=8.2===
Attribute "SensitiveParameter" must not be repeated
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file, expecting variable (T_VARIABLE) in Standard input code on line 2
===php_error >=8.2===
PHP Fatal error:  Attribute "SensitiveParameter" must not be repeated in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "h",
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
                "start": 17,
                "end": 17
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
            "name": "h",
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
                  "start": 59,
                  "end": 61
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [
                {
                  "name": {
                    "parts": [
                      "SensitiveParameter"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 19,
                      "end": 37
                    }
                  },
                  "args": [],
                  "span": {
                    "start": 19,
                    "end": 37
                  }
                },
                {
                  "name": {
                    "parts": [
                      "SensitiveParameter"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 39,
                      "end": 57
                    }
                  },
                  "args": [],
                  "span": {
                    "start": 39,
                    "end": 57
                  }
                }
              ],
              "span": {
                "start": 17,
                "end": 61
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
        "end": 65
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 65
  }
}
