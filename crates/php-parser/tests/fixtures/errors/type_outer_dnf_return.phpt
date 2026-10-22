===source===
<?php
function foo(): (A|B)&C { }

===errors <=8.0===
expected '&', found '|'
'parenthesized union types' requires PHP 8.2 or higher
'intersection types' requires PHP 8.1 or higher
Type declarations cannot be union types, use DNF syntax (A&B)|C instead
===errors 8.1===
expected '&', found '|'
'parenthesized union types' requires PHP 8.2 or higher
Type declarations cannot be union types, use DNF syntax (A&B)|C instead
===errors >=8.2===
expected '&', found '|'
Type declarations cannot be union types, use DNF syntax (A&B)|C instead
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '(' in Standard input code on line 2
===php_error 8.0-8.1===
PHP Parse error:  syntax error, unexpected token "(" in Standard input code on line 2
===php_error 8.2-8.4===
PHP Parse error:  syntax error, unexpected token "|", expecting amp in Standard input code on line 2
===php_error >=8.5===
PHP Parse error:  syntax error, unexpected token "|", expecting token "&" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "foo",
            "span": {
              "start": 15,
              "end": 18
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Intersection": [
                {
                  "kind": {
                    "Union": [
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "A"
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
                      },
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "B"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 25,
                              "end": 26
                            }
                          }
                        },
                        "span": {
                          "start": 25,
                          "end": 26
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 22,
                    "end": 27
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "C"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 28,
                        "end": 29
                      }
                    }
                  },
                  "span": {
                    "start": 28,
                    "end": 29
                  }
                }
              ]
            },
            "span": {
              "start": 22,
              "end": 29
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
