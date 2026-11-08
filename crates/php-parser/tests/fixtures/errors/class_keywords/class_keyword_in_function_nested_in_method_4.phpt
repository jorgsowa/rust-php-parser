===description===
Holds a single class keyword reference, so no other one turns the check on.
===source===
<?php class A { function f() { function g($x) { return $x instanceof static; } } }
===errors===
Cannot use "static" when no class scope is active
===php_error===
PHP Fatal error:  Cannot use "static" when no class scope is active in Standard input code on line 1
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
                        "Function": {
                          "name": {
                            "name": "g",
                            "span": {
                              "start": 40,
                              "end": 41
                            }
                          },
                          "params": [
                            {
                              "name": {
                                "name": "x",
                                "span": {
                                  "start": 42,
                                  "end": 44
                                }
                              },
                              "type_hint": null,
                              "default": null,
                              "by_ref": false,
                              "variadic": false,
                              "attributes": [],
                              "span": {
                                "start": 42,
                                "end": 44
                              }
                            }
                          ],
                          "body": [
                            {
                              "kind": {
                                "Return": {
                                  "kind": {
                                    "Binary": {
                                      "left": {
                                        "kind": {
                                          "Variable": "x"
                                        },
                                        "span": {
                                          "start": 55,
                                          "end": 57
                                        }
                                      },
                                      "op": "Instanceof",
                                      "right": {
                                        "kind": {
                                          "Name": {
                                            "parts": [
                                              "static"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 69,
                                              "end": 75
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 69,
                                          "end": 75
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 55,
                                    "end": 75
                                  }
                                }
                              },
                              "span": {
                                "start": 48,
                                "end": 76
                              }
                            }
                          ],
                          "return_type": null,
                          "by_ref": false,
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 31,
                        "end": 78
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 80
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 82
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 82
  }
}
