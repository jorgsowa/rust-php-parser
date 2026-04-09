===config===
min_php=8.5
===source===
<?php
class User {
    public protected(set) string $name;
    public private(set) int $age;
    protected private(set) string $email = '';
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "User",
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
                  "name": "name",
                  "visibility": "Public",
                  "set_visibility": "Protected",
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
                          "start": 45,
                          "end": 51,
                          "start_line": 3,
                          "start_col": 26
                        }
                      }
                    },
                    "span": {
                      "start": 45,
                      "end": 51,
                      "start_line": 3,
                      "start_col": 26
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 23,
                "end": 57,
                "start_line": 3,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "age",
                  "visibility": "Public",
                  "set_visibility": "Private",
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 83,
                          "end": 86,
                          "start_line": 4,
                          "start_col": 24
                        }
                      }
                    },
                    "span": {
                      "start": 83,
                      "end": 86,
                      "start_line": 4,
                      "start_col": 24
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 63,
                "end": 91,
                "start_line": 4,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "email",
                  "visibility": "Protected",
                  "set_visibility": "Private",
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
                          "start": 120,
                          "end": 126,
                          "start_line": 5,
                          "start_col": 27
                        }
                      }
                    },
                    "span": {
                      "start": 120,
                      "end": 126,
                      "start_line": 5,
                      "start_col": 27
                    }
                  },
                  "default": {
                    "kind": {
                      "String": ""
                    },
                    "span": {
                      "start": 136,
                      "end": 138,
                      "start_line": 5,
                      "start_col": 43
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 97,
                "end": 138,
                "start_line": 5,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 141,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 141,
    "start_line": 1,
    "start_col": 0
  }
}
