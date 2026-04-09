===source===
<?php
trait A { public function foo() {} }
trait B { public function foo() {} public function bar() {} }
class C {
    use A, B {
        B::foo insteadof A;
        A::foo as private afoo;
        B::bar as public bbar;
    }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": "A",
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "foo",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 41,
                "start_line": 2,
                "start_col": 10
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 42,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Trait": {
          "name": "B",
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "foo",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 53,
                "end": 78,
                "start_line": 3,
                "start_col": 10
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "bar",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 78,
                "end": 103,
                "start_line": 3,
                "start_col": 35
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 43,
        "end": 104,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Class": {
          "name": "C",
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
                "TraitUse": {
                  "traits": [
                    {
                      "parts": [
                        "A"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 123,
                        "end": 124,
                        "start_line": 5,
                        "start_col": 8
                      }
                    },
                    {
                      "parts": [
                        "B"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 126,
                        "end": 128,
                        "start_line": 5,
                        "start_col": 11
                      }
                    }
                  ],
                  "adaptations": [
                    {
                      "kind": {
                        "Precedence": {
                          "trait_name": {
                            "parts": [
                              "B"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 138,
                              "end": 139,
                              "start_line": 6,
                              "start_col": 8
                            }
                          },
                          "method": "foo",
                          "insteadof": [
                            {
                              "parts": [
                                "A"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 155,
                                "end": 156,
                                "start_line": 6,
                                "start_col": 25
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 138,
                        "end": 166,
                        "start_line": 6,
                        "start_col": 8
                      }
                    },
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": {
                            "parts": [
                              "A"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 166,
                              "end": 167,
                              "start_line": 7,
                              "start_col": 8
                            }
                          },
                          "method": "foo",
                          "new_modifier": "Private",
                          "new_name": "afoo"
                        }
                      },
                      "span": {
                        "start": 166,
                        "end": 198,
                        "start_line": 7,
                        "start_col": 8
                      }
                    },
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": {
                            "parts": [
                              "B"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 198,
                              "end": 199,
                              "start_line": 8,
                              "start_col": 8
                            }
                          },
                          "method": "bar",
                          "new_modifier": "Public",
                          "new_name": "bbar"
                        }
                      },
                      "span": {
                        "start": 198,
                        "end": 225,
                        "start_line": 8,
                        "start_col": 8
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 119,
                "end": 227,
                "start_line": 5,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 105,
        "end": 228,
        "start_line": 4,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 228,
    "start_line": 1,
    "start_col": 0
  }
}
