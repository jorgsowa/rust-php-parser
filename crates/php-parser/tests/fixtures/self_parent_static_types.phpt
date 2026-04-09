===source===
<?php
class Builder {
    public function setName(string $name): self { return $this; }
    public static function create(): static { return new static(); }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Builder",
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
                  "name": "setName",
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
                              "start": 50,
                              "end": 56,
                              "start_line": 3,
                              "start_col": 28
                            }
                          }
                        },
                        "span": {
                          "start": 50,
                          "end": 56,
                          "start_line": 3,
                          "start_col": 28
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
                        "start": 50,
                        "end": 62,
                        "start_line": 3,
                        "start_col": 28
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "self"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 65,
                          "end": 69,
                          "start_line": 3,
                          "start_col": 43
                        }
                      }
                    },
                    "span": {
                      "start": 65,
                      "end": 69,
                      "start_line": 3,
                      "start_col": 43
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Variable": "this"
                          },
                          "span": {
                            "start": 79,
                            "end": 84,
                            "start_line": 3,
                            "start_col": 57
                          }
                        }
                      },
                      "span": {
                        "start": 72,
                        "end": 86,
                        "start_line": 3,
                        "start_col": 50
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 26,
                "end": 92,
                "start_line": 3,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "create",
                  "visibility": "Public",
                  "is_static": true,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "static"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 125,
                          "end": 131,
                          "start_line": 4,
                          "start_col": 37
                        }
                      }
                    },
                    "span": {
                      "start": 125,
                      "end": 131,
                      "start_line": 4,
                      "start_col": 37
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "New": {
                              "class": {
                                "kind": {
                                  "Identifier": "static"
                                },
                                "span": {
                                  "start": 145,
                                  "end": 151,
                                  "start_line": 4,
                                  "start_col": 57
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 141,
                            "end": 153,
                            "start_line": 4,
                            "start_col": 53
                          }
                        }
                      },
                      "span": {
                        "start": 134,
                        "end": 155,
                        "start_line": 4,
                        "start_col": 46
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 92,
                "end": 157,
                "start_line": 4,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 158,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 158,
    "start_line": 1,
    "start_col": 0
  }
}
