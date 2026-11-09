===source===
<?php
const O = throw new E;
===errors <=7.4===
'throw expressions' requires PHP 8.0 or higher
Constant expression contains invalid operations
===errors >=8.0===
Constant expression contains invalid operations
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'throw' (T_THROW) in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "O",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "Throw": {
                  "kind": {
                    "New": {
                      "class": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "E"
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
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 22,
                    "end": 27
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 27
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 27
            }
          }
        ]
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
