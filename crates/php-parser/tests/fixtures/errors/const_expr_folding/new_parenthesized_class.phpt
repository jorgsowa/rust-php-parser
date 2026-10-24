===source===
<?php
const A = new (B);
===errors <=7.4===
'new with an expression' requires PHP 8.0 or higher
'new in initializers' requires PHP 8.1 or higher
===errors 8.0===
'new in initializers' requires PHP 8.1 or higher
===errors >=8.1===
Cannot use dynamic class name in constant expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '(' in Standard input code on line 2
===php_error 8.0===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  Cannot use dynamic class name in constant expression in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "A",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "New": {
                  "class": {
                    "kind": {
                      "Parenthesized": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "B"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 21,
                              "end": 22
                            }
                          }
                        },
                        "span": {
                          "start": 21,
                          "end": 22
                        }
                      }
                    },
                    "span": {
                      "start": 20,
                      "end": 23
                    }
                  },
                  "args": []
                }
              },
              "span": {
                "start": 16,
                "end": 23
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 23
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
