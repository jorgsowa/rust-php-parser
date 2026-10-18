===source===
<?php $a?->b::$c->d(...);
===errors===
Cannot combine nullsafe operator with Closure creation
===php_error===
PHP Fatal error:  Cannot combine nullsafe operator with Closure creation in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "CallableCreate": {
              "kind": {
                "Method": {
                  "object": {
                    "kind": {
                      "StaticPropertyAccess": {
                        "class": {
                          "kind": {
                            "NullsafePropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 6,
                                  "end": 8
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "b"
                                },
                                "span": {
                                  "start": 11,
                                  "end": 12
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 6,
                            "end": 12
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "c"
                          },
                          "span": {
                            "start": 14,
                            "end": 16
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 6,
                      "end": 16
                    }
                  },
                  "method": {
                    "kind": {
                      "Identifier": "d"
                    },
                    "span": {
                      "start": 18,
                      "end": 19
                    }
                  }
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 24
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
