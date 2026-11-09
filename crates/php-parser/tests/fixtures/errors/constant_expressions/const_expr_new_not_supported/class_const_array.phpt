===source===
<?php
class C {
    const A = [new Foo];
}
===errors===
New expressions are not supported in this context
===php_error <=8.0===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 3
===php_error >=8.1===
PHP Fatal error:  New expressions are not supported in this context in Standard input code on line 3
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
                "ClassConst": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 26,
                      "end": 27
                    }
                  },
                  "value": {
                    "kind": {
                      "Array": [
                        {
                          "key": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "New": {
                                  "class": {
                                    "kind": {
                                      "Name": {
                                        "parts": [
                                          "Foo"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 35,
                                          "end": 38
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 35,
                                      "end": 38
                                    }
                                  },
                                  "args": []
                                }
                              },
                              "span": {
                                "start": 31,
                                "end": 38
                              }
                            }
                          },
                          "span": {
                            "start": 31,
                            "end": 38
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 30,
                      "end": 39
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 40
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 42
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 42
  }
}
