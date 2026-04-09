===config===
min_php=8.2
===source===
<?php
abstract class Base {
    abstract public function doSomething(): void;
}
final class Sealed {
    public function run(): void {}
}
readonly class Value {
    public function __construct(
        public string $name,
        public int $age,
    ) {}
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Base",
          "modifiers": {
            "is_abstract": true,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "doSomething",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": true,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 72,
                          "end": 76,
                          "start_line": 3,
                          "start_col": 44
                        }
                      }
                    },
                    "span": {
                      "start": 72,
                      "end": 76,
                      "start_line": 3,
                      "start_col": 44
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 32,
                "end": 78,
                "start_line": 3,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 79,
        "start_line": 2,
        "start_col": 9
      }
    },
    {
      "kind": {
        "Class": {
          "name": "Sealed",
          "modifiers": {
            "is_abstract": false,
            "is_final": true,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "run",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 128,
                          "end": 132,
                          "start_line": 6,
                          "start_col": 27
                        }
                      }
                    },
                    "span": {
                      "start": 128,
                      "end": 132,
                      "start_line": 6,
                      "start_col": 27
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 105,
                "end": 136,
                "start_line": 6,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 86,
        "end": 137,
        "start_line": 5,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Class": {
          "name": "Value",
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": true
          },
          "extends": null,
          "implements": [],
          "members": [
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
                      "name": "name",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 209,
                              "end": 215,
                              "start_line": 10,
                              "start_col": 15
                            }
                          }
                        },
                        "span": {
                          "start": 209,
                          "end": 215,
                          "start_line": 10,
                          "start_col": 15
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Public",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 202,
                        "end": 221,
                        "start_line": 10,
                        "start_col": 8
                      }
                    },
                    {
                      "name": "age",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 238,
                              "end": 241,
                              "start_line": 11,
                              "start_col": 15
                            }
                          }
                        },
                        "span": {
                          "start": 238,
                          "end": 241,
                          "start_line": 11,
                          "start_col": 15
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Public",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 231,
                        "end": 246,
                        "start_line": 11,
                        "start_col": 8
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 165,
                "end": 257,
                "start_line": 9,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 147,
        "end": 258,
        "start_line": 8,
        "start_col": 9
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 258,
    "start_line": 1,
    "start_col": 0
  }
}
