===source===
<?php
function a(): int&A {}
===errors <=8.0===
'intersection types' requires PHP 8.1 or higher
Type int cannot be part of an intersection type
===errors >=8.1===
Type int cannot be part of an intersection type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '&', expecting '{' in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "&", expecting "{" in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  Type int cannot be part of an intersection type in Standard input code on line 2
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
              "Intersection": [
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
                        "A"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 24,
                        "end": 25
                      }
                    }
                  },
                  "span": {
                    "start": 24,
                    "end": 25
                  }
                }
              ]
            },
            "span": {
              "start": 20,
              "end": 25
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}
