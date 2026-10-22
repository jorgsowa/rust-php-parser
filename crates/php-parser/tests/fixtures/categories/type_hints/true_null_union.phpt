===source===
<?php function f(): true|null { return null; }
===errors <=7.4===
'true type' requires PHP 8.2 or higher
'union types' requires PHP 8.0 or higher
'null type' requires PHP 8.0 or higher
===errors 8.0-8.1===
'true type' requires PHP 8.2 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting '{' in Standard input code on line 1
===php_error 8.0-8.1===
PHP Fatal error:  Cannot use 'true' as class name as it is reserved in Standard input code on line 1
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
                    "start": 39,
                    "end": 43
                  }
                }
              },
              "span": {
                "start": 32,
                "end": 44
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
                        "true"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 20,
                        "end": 24
                      }
                    }
                  },
                  "span": {
                    "start": 20,
                    "end": 24
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
                        "start": 25,
                        "end": 29
                      }
                    }
                  },
                  "span": {
                    "start": 25,
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
        "end": 46
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46
  }
}
