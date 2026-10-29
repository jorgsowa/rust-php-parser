===source===
<?php
enum E: (A&B)|int {}
===errors <=7.4===
'enums' requires PHP 8.1 or higher
'intersection types' requires PHP 8.1 or higher
'union types' requires PHP 8.0 or higher
'DNF types' requires PHP 8.2 or higher
Enum backing type must be int or string, (A&B)|int given
===errors 8.0===
'enums' requires PHP 8.1 or higher
'intersection types' requires PHP 8.1 or higher
'DNF types' requires PHP 8.2 or higher
Enum backing type must be int or string, (A&B)|int given
===errors 8.1===
'DNF types' requires PHP 8.2 or higher
Enum backing type must be int or string, (A&B)|int given
===errors >=8.2===
Enum backing type must be int or string, (A&B)|int given
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 2
===php_error 8.1===
PHP Parse error:  syntax error, unexpected token "(" in Standard input code on line 2
===php_error >=8.2===
PHP Fatal error:  Enum backing type must be int or string, (A&B)|int given in Standard input code on line 2
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
                    "Intersection": [
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "A"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 15,
                              "end": 16
                            }
                          }
                        },
                        "span": {
                          "start": 15,
                          "end": 16
                        }
                      },
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "B"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 17,
                              "end": 18
                            }
                          }
                        },
                        "span": {
                          "start": 17,
                          "end": 18
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 14,
                    "end": 19
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
                        "start": 20,
                        "end": 23
                      }
                    }
                  },
                  "span": {
                    "start": 20,
                    "end": 23
                  }
                }
              ]
            },
            "span": {
              "start": 14,
              "end": 23
            }
          },
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 26
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26
  }
}
