===source===
<?php
class A {
    function __isset($n): bool|int {}
}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
===errors >=8.0===
A::__isset(): Return type must be bool when declared
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting ';' or '{' in Standard input code on line 3
===php_error >=8.0===
PHP Fatal error:  A::__isset(): Return type must be bool when declared in Standard input code on line 3
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
                "Method": {
                  "name": {
                    "name": "__isset",
                    "span": {
                      "start": 29,
                      "end": 36
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 37,
                          "end": 39
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 37,
                        "end": 39
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Union": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "bool"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 42,
                                "end": 46
                              }
                            }
                          },
                          "span": {
                            "start": 42,
                            "end": 46
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
                                "start": 47,
                                "end": 50
                              }
                            }
                          },
                          "span": {
                            "start": 47,
                            "end": 50
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 42,
                      "end": 50
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 53
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 55
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 55
  }
}
