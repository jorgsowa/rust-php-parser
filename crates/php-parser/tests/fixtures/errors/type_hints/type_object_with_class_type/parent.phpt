===source===
<?php
class C extends P {
    public function f(): parent|object {}
}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
Type parent|object contains both object and a class type, which is redundant
===errors 8.0-8.4===
Type parent|object contains both object and a class type, which is redundant
===errors >=8.5===
Type P|object contains both object and a class type, which is redundant
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting ';' or '{' in Standard input code on line 3
===php_error 8.0-8.4===
PHP Fatal error:  Type parent|object contains both object and a class type, which is redundant in Standard input code on line 3
===php_error >=8.5===
PHP Fatal error:  Type P|object contains both object and a class type, which is redundant in Standard input code on line 3
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
          "extends": {
            "parts": [
              "P"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 22,
              "end": 23
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 46,
                      "end": 47
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
                                "parent"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 51,
                                "end": 57
                              }
                            }
                          },
                          "span": {
                            "start": 51,
                            "end": 57
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
                                "start": 58,
                                "end": 64
                              }
                            }
                          },
                          "span": {
                            "start": 58,
                            "end": 64
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 51,
                      "end": 64
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 30,
                "end": 67
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 69
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 69
  }
}
