===source===
<?php
class A {
    public function f() {
        return function (): never {
            return;
        };
    }
}
===errors <=8.0===
A function with return type must return a value
===errors 8.1-8.3===
A never-returning function must not return
===errors >=8.4===
A never-returning method must not return
===php_error <=8.0===
PHP Fatal error:  A function with return type must return a value in Standard input code on line 5
===php_error 8.1-8.3===
PHP Fatal error:  A never-returning function must not return in Standard input code on line 5
===php_error >=8.4===
PHP Fatal error:  A never-returning method must not return in Standard input code on line 5
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
                    "name": "f",
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
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Closure": {
                              "is_static": false,
                              "by_ref": false,
                              "params": [],
                              "use_vars": [],
                              "return_type": {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "never"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 70,
                                      "end": 75
                                    }
                                  }
                                },
                                "span": {
                                  "start": 70,
                                  "end": 75
                                }
                              },
                              "body": [
                                {
                                  "kind": {
                                    "Return": null
                                  },
                                  "span": {
                                    "start": 90,
                                    "end": 97
                                  }
                                }
                              ],
                              "attributes": []
                            }
                          },
                          "span": {
                            "start": 57,
                            "end": 107
                          }
                        }
                      },
                      "span": {
                        "start": 50,
                        "end": 108
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 114
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 116
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 116
  }
}
