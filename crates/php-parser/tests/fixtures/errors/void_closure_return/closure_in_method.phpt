===source===
<?php
class A { function m() { return function(): void { return 1; }; } }
===errors <=8.3===
A void function must not return a value
===errors >=8.4===
A void method must not return a value
===php_error <=8.3===
PHP Fatal error:  A void function must not return a value in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  A void method must not return a value in Standard input code on line 2
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
                    "name": "m",
                    "span": {
                      "start": 25,
                      "end": 26
                    }
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
                                      "void"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 50,
                                      "end": 54
                                    }
                                  }
                                },
                                "span": {
                                  "start": 50,
                                  "end": 54
                                }
                              },
                              "body": [
                                {
                                  "kind": {
                                    "Return": {
                                      "kind": {
                                        "Int": 1
                                      },
                                      "span": {
                                        "start": 64,
                                        "end": 65
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 57,
                                    "end": 66
                                  }
                                }
                              ],
                              "attributes": []
                            }
                          },
                          "span": {
                            "start": 38,
                            "end": 68
                          }
                        }
                      },
                      "span": {
                        "start": 31,
                        "end": 69
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 71
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 73
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 73
  }
}
