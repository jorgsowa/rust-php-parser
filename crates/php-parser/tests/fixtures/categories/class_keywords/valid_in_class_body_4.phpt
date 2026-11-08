===description===
Holds a single class keyword reference, so no other one turns the check on.
===source===
<?php trait T { function f() { return parent::g(); } }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 12,
              "end": 13
            }
          },
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
                        "Return": {
                          "kind": {
                            "StaticMethodCall": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "parent"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 38,
                                      "end": 44
                                    }
                                  }
                                },
                                "span": {
                                  "start": 38,
                                  "end": 44
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "g"
                                },
                                "span": {
                                  "start": 46,
                                  "end": 47
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 38,
                            "end": 49
                          }
                        }
                      },
                      "span": {
                        "start": 31,
                        "end": 50
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 52
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 54
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 54
  }
}
