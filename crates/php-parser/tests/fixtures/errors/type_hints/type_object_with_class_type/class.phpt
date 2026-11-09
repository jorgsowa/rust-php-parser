===source===
<?php
function a(): object|A {}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
Type A|object contains both object and a class type, which is redundant
===errors >=8.0===
Type A|object contains both object and a class type, which is redundant
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting '{' in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  Type A|object contains both object and a class type, which is redundant in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "a",
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
                        "object"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 20,
                        "end": 26
                      }
                    }
                  },
                  "span": {
                    "start": 20,
                    "end": 26
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "A"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 27,
                        "end": 28
                      }
                    }
                  },
                  "span": {
                    "start": 27,
                    "end": 28
                  }
                }
              ]
            },
            "span": {
              "start": 20,
              "end": 28
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}
