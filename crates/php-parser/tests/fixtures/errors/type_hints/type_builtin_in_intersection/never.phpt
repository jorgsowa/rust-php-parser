===source===
<?php
function j(): never&A {}
===errors <=8.0===
'intersection types' requires PHP 8.1 or higher
===errors >=8.1===
Type never cannot be part of an intersection type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '&', expecting '{' in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "&", expecting "{" in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  Type never cannot be part of an intersection type in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "j",
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
                        "never"
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
                        "A"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 26,
                        "end": 27
                      }
                    }
                  },
                  "span": {
                    "start": 26,
                    "end": 27
                  }
                }
              ]
            },
            "span": {
              "start": 20,
              "end": 27
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 30
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30
  }
}
