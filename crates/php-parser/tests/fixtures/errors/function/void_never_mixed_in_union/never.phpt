===source===
<?php
function b(): int|never {}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
===errors >=8.1===
never can only be used as a standalone type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting '{' in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  never can only be used as a standalone type in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "b",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "int"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 20,
                        "end": 23
                      }
                    }
                  },
                  "span": {
                    "start": 20,
                    "end": 23
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "never"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 24,
                        "end": 29
                      }
                    }
                  },
                  "span": {
                    "start": 24,
                    "end": 29
                  }
                }
              ]
            },
            "span": {
              "start": 20,
              "end": 29
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
