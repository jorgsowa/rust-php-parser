===source===
<?php function f(): false|null { return null; }
===errors <=7.4===
'false type' requires PHP 8.0 or higher
'union types' requires PHP 8.0 or higher
'null type' requires PHP 8.0 or higher
'false as standalone type' requires PHP 8.2 or higher
===errors 8.0-8.1===
'false as standalone type' requires PHP 8.2 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting '{' in Standard input code on line 1
===php_error 8.0-8.1===
PHP Fatal error:  False can not be used as a standalone type in Standard input code on line 1
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
          "params": [],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": "Null",
                  "span": {
                    "start": 40,
                    "end": 44
                  }
                }
              },
              "span": {
                "start": 33,
                "end": 45
              }
            }
          ],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "false"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 20,
                        "end": 25
                      }
                    }
                  },
                  "span": {
                    "start": 20,
                    "end": 25
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "null"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 26,
                        "end": 30
                      }
                    }
                  },
                  "span": {
                    "start": 26,
                    "end": 30
                  }
                }
              ]
            },
            "span": {
              "start": 20,
              "end": 30
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 47
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47
  }
}
