===source===
<?php
function d(): iterable|array {}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
Duplicate type array is redundant
===errors >=8.0===
Duplicate type array is redundant
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting '{' in Standard input code on line 2
===php_error 8.0-8.1===
PHP Fatal error:  Type iterable|array contains both iterable and array, which is redundant in Standard input code on line 2
===php_error >=8.2===
PHP Fatal error:  Duplicate type array is redundant in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "d",
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
                        "iterable"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 20,
                        "end": 28
                      }
                    }
                  },
                  "span": {
                    "start": 20,
                    "end": 28
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "array"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 29,
                        "end": 34
                      }
                    }
                  },
                  "span": {
                    "start": 29,
                    "end": 34
                  }
                }
              ]
            },
            "span": {
              "start": 20,
              "end": 34
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 37
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37
  }
}
