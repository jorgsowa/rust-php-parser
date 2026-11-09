===source===
<?php
function f() {
    return "{${self::X}}";
}
===errors===
Cannot use "self" when no class scope is active
===php_error===
PHP Fatal error:  Cannot use "self" when no class scope is active in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "InterpolatedString": [
                      {
                        "Expr": {
                          "kind": {
                            "VariableVariable": {
                              "kind": {
                                "ClassConstAccess": {
                                  "class": {
                                    "kind": {
                                      "Name": {
                                        "parts": [
                                          "self"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 36,
                                          "end": 40
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 36,
                                      "end": 40
                                    }
                                  },
                                  "member": {
                                    "kind": {
                                      "Identifier": "X"
                                    },
                                    "span": {
                                      "start": 42,
                                      "end": 43
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 36,
                                "end": 43
                              }
                            }
                          },
                          "span": {
                            "start": 34,
                            "end": 44
                          }
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 32,
                    "end": 46
                  }
                }
              },
              "span": {
                "start": 25,
                "end": 47
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 49
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 49
  }
}
