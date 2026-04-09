===source===
<?php
class A {
    /** @var ?string */
    private $foo

    public function __construct(string $s) {
        $this->foo = $s;
    }
}
class B {
    const X = 1
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "A",
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
                "Property": {
                  "name": "foo",
                  "visibility": "Private",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/** @var ?string */",
                    "span": {
                      "start": 20,
                      "end": 39,
                      "start_line": 3,
                      "start_col": 4
                    }
                  }
                }
              },
              "span": {
                "start": 44,
                "end": 62,
                "start_line": 4,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "__construct",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "s",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 90,
                              "end": 96,
                              "start_line": 6,
                              "start_col": 32
                            }
                          }
                        },
                        "span": {
                          "start": 90,
                          "end": 96,
                          "start_line": 6,
                          "start_col": 32
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 90,
                        "end": 99,
                        "start_line": 6,
                        "start_col": 32
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "Assign": {
                              "target": {
                                "kind": {
                                  "PropertyAccess": {
                                    "object": {
                                      "kind": {
                                        "Variable": "this"
                                      },
                                      "span": {
                                        "start": 111,
                                        "end": 116,
                                        "start_line": 7,
                                        "start_col": 8
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "foo"
                                      },
                                      "span": {
                                        "start": 118,
                                        "end": 121,
                                        "start_line": 7,
                                        "start_col": 15
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 111,
                                  "end": 121,
                                  "start_line": 7,
                                  "start_col": 8
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "Variable": "s"
                                },
                                "span": {
                                  "start": 124,
                                  "end": 126,
                                  "start_line": 7,
                                  "start_col": 21
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 111,
                            "end": 126,
                            "start_line": 7,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 111,
                        "end": 132,
                        "start_line": 7,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 62,
                "end": 134,
                "start_line": 6,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 135,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Class": {
          "name": "B",
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
                  "name": "X",
                  "visibility": null,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 160,
                      "end": 161,
                      "start_line": 11,
                      "start_col": 14
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 150,
                "end": 162,
                "start_line": 11,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 136,
        "end": 163,
        "start_line": 10,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 163,
    "start_line": 1,
    "start_col": 0
  }
}
