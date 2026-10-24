===source===
<?php
class A {
    public string|int $x = null;
}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
Default value for property of type string|int may not be null. Use the nullable type string|int|null to allow null default value
===errors >=8.0===
Default value for property of type string|int may not be null. Use the nullable type string|int|null to allow null default value
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error >=8.0===
PHP Fatal error:  Default value for property of type string|int may not be null. Use the nullable type string|int|null to allow null default value in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
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
                "Property": {
                  "name": {
                    "name": "x",
                    "span": {
                      "start": 38,
                      "end": 40
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
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
                                "start": 27,
                                "end": 33
                              }
                            }
                          },
                          "span": {
                            "start": 27,
                            "end": 33
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
                                "start": 34,
                                "end": 37
                              }
                            }
                          },
                          "span": {
                            "start": 34,
                            "end": 37
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 27,
                      "end": 37
                    }
                  },
                  "default": {
                    "kind": "Null",
                    "span": {
                      "start": 43,
                      "end": 47
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 47
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 50
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 50
  }
}
