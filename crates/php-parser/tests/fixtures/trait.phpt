===source===
<?php
trait Timestampable {
    public function getCreatedAt(): string {
        return $this->createdAt;
    }
}
class Post {
    use Timestampable;
    public string $title;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": "Timestampable",
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "getCreatedAt",
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
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 64,
                          "end": 70,
                          "start_line": 3,
                          "start_col": 36
                        }
                      }
                    },
                    "span": {
                      "start": 64,
                      "end": 70,
                      "start_line": 3,
                      "start_col": 36
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 88,
                                  "end": 93,
                                  "start_line": 4,
                                  "start_col": 15
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "createdAt"
                                },
                                "span": {
                                  "start": 95,
                                  "end": 104,
                                  "start_line": 4,
                                  "start_col": 22
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 88,
                            "end": 104,
                            "start_line": 4,
                            "start_col": 15
                          }
                        }
                      },
                      "span": {
                        "start": 81,
                        "end": 110,
                        "start_line": 4,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 32,
                "end": 112,
                "start_line": 3,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 113,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Class": {
          "name": "Post",
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
                        "Timestampable"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 135,
                        "end": 148,
                        "start_line": 8,
                        "start_col": 8
                      }
                    }
                  ],
                  "adaptations": []
                }
              },
              "span": {
                "start": 131,
                "end": 154,
                "start_line": 8,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "title",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 161,
                          "end": 167,
                          "start_line": 9,
                          "start_col": 11
                        }
                      }
                    },
                    "span": {
                      "start": 161,
                      "end": 167,
                      "start_line": 9,
                      "start_col": 11
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 154,
                "end": 174,
                "start_line": 9,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 114,
        "end": 177,
        "start_line": 7,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 177,
    "start_line": 1,
    "start_col": 0
  }
}
