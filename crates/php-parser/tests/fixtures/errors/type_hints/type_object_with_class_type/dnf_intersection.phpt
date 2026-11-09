===source===
<?php
function c(): (A&B)|object {}
===errors <=7.4===
'intersection types' requires PHP 8.1 or higher
'union types' requires PHP 8.0 or higher
'DNF types' requires PHP 8.2 or higher
Type (A&B)|object contains both object and a class type, which is redundant
===errors 8.0===
'intersection types' requires PHP 8.1 or higher
'DNF types' requires PHP 8.2 or higher
Type (A&B)|object contains both object and a class type, which is redundant
===errors 8.1===
'DNF types' requires PHP 8.2 or higher
Type (A&B)|object contains both object and a class type, which is redundant
===errors >=8.2===
Type (A&B)|object contains both object and a class type, which is redundant
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '(' in Standard input code on line 2
===php_error 8.0-8.1===
PHP Parse error:  syntax error, unexpected token "(" in Standard input code on line 2
===php_error >=8.2===
PHP Fatal error:  Type (A&B)|object contains both object and a class type, which is redundant in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "c",
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
                    "Intersection": [
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "A"
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
                      },
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "B"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 23,
                              "end": 24
                            }
                          }
                        },
                        "span": {
                          "start": 23,
                          "end": 24
                        }
                      }
                    ]
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
                        "object"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 26,
                        "end": 32
                      }
                    }
                  },
                  "span": {
                    "start": 26,
                    "end": 32
                  }
                }
              ]
            },
            "span": {
              "start": 20,
              "end": 32
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}
