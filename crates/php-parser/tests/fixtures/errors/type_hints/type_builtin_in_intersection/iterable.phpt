===source===
<?php
function g(): iterable&A {}
===errors <=8.0===
'intersection types' requires PHP 8.1 or higher
Type iterable cannot be part of an intersection type
===errors 8.1===
Type iterable cannot be part of an intersection type
===errors >=8.2===
Type Traversable|array cannot be part of an intersection type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '&', expecting '{' in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "&", expecting "{" in Standard input code on line 2
===php_error 8.1===
PHP Fatal error:  Type iterable cannot be part of an intersection type in Standard input code on line 2
===php_error >=8.2===
PHP Fatal error:  Type Traversable|array cannot be part of an intersection type in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
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
                        "A"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 29,
                        "end": 30
                      }
                    }
                  },
                  "span": {
                    "start": 29,
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
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
