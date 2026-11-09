===source===
<?php
enum E: Bar|int { case A = 1; }
===errors <=7.4===
'enums' requires PHP 8.1 or higher
'union types' requires PHP 8.0 or higher
Enum backing type must be int or string, Bar|int given
===errors 8.0===
'enums' requires PHP 8.1 or higher
Enum backing type must be int or string, Bar|int given
===errors >=8.1===
Enum backing type must be int or string, Bar|int given
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  Enum backing type must be int or string, Bar|int given in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 11,
              "end": 12
            }
          },
          "scalar_type": null,
          "invalid_scalar_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "Bar"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 14,
                        "end": 17
                      }
                    }
                  },
                  "span": {
                    "start": 14,
                    "end": 17
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "int"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 18,
                        "end": 21
                      }
                    }
                  },
                  "span": {
                    "start": 18,
                    "end": 21
                  }
                }
              ]
            },
            "span": {
              "start": 14,
              "end": 21
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 29,
                      "end": 30
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 33,
                      "end": 34
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 35
              }
            }
          ],
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
