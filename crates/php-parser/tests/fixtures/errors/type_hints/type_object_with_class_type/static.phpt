===source===
<?php
class C {
    public function g(): object|static {}
}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
'static type' requires PHP 8.0 or higher
Type static|object contains both object and a class type, which is redundant
===errors >=8.0===
Type static|object contains both object and a class type, which is redundant
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting ';' or '{' in Standard input code on line 3
===php_error >=8.0===
PHP Fatal error:  Type static|object contains both object and a class type, which is redundant in Standard input code on line 3
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
                    "name": "g",
                    "span": {
                      "start": 36,
                      "end": 37
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
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
                                "object"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 41,
                                "end": 47
                              }
                            }
                          },
                          "span": {
                            "start": 41,
                            "end": 47
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "static"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 48,
                                "end": 54
                              }
                            }
                          },
                          "span": {
                            "start": 48,
                            "end": 54
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 41,
                      "end": 54
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 57
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 59
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 59
  }
}
