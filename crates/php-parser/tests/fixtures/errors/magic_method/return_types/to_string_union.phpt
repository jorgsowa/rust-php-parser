===source===
<?php
class C {
    function __toString(): string|Foo {}
}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
===errors >=8.0===
C::__toString(): Return type must be string when declared
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting ';' or '{' in Standard input code on line 3
===php_error >=8.0===
PHP Fatal error:  C::__toString(): Return type must be string when declared in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__toString",
                    "span": {
                      "start": 29,
                      "end": 39
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Union": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "string"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 43,
                                "end": 49
                              }
                            }
                          },
                          "span": {
                            "start": 43,
                            "end": 49
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "Foo"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 50,
                                "end": 53
                              }
                            }
                          },
                          "span": {
                            "start": 50,
                            "end": 53
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 43,
                      "end": 53
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 56
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 58
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 58
  }
}
