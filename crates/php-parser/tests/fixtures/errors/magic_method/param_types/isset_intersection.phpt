===source===
<?php
class A {
    function __isset(Foo&Bar $n) {}
}
===errors <=7.4===
'intersection types' requires PHP 8.1 or higher
===errors 8.0===
'intersection types' requires PHP 8.1 or higher
A::__isset(): Parameter #1 ($n) must be of type string when declared
===errors >=8.1===
A::__isset(): Parameter #1 ($n) must be of type string when declared
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Bar' (T_STRING), expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "Bar", expecting variable in Standard input code on line 3
===php_error >=8.1===
PHP Fatal error:  A::__isset(): Parameter #1 ($n) must be of type string when declared in Standard input code on line 3
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
                          "start": 45,
                          "end": 47
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Intersection": [
                            {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "Foo"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 37,
                                    "end": 40
                                  }
                                }
                              },
                              "span": {
                                "start": 37,
                                "end": 40
                              }
                            },
                            {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "Bar"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 41,
                                    "end": 44
                                  }
                                }
                              },
                              "span": {
                                "start": 41,
                                "end": 44
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 37,
                          "end": 44
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 37,
                        "end": 47
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 51
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 53
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 53
  }
}
