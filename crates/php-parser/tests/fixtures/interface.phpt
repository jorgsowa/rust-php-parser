===source===
<?php
interface HasId {
    public function getId(): int;
}
interface HasName extends HasId {
    public function getName(): string;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": "HasId",
          "extends": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "getId",
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
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 53,
                          "end": 56,
                          "start_line": 3,
                          "start_col": 29
                        }
                      }
                    },
                    "span": {
                      "start": 53,
                      "end": 56,
                      "start_line": 3,
                      "start_col": 29
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 28,
                "end": 58,
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
        "end": 59,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Interface": {
          "name": "HasName",
          "extends": [
            {
              "parts": [
                "HasId"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 86,
                "end": 92,
                "start_line": 5,
                "start_col": 26
              }
            }
          ],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "getName",
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
                          "start": 125,
                          "end": 131,
                          "start_line": 6,
                          "start_col": 31
                        }
                      }
                    },
                    "span": {
                      "start": 125,
                      "end": 131,
                      "start_line": 6,
                      "start_col": 31
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 98,
                "end": 133,
                "start_line": 6,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 60,
        "end": 134,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 134,
    "start_line": 1,
    "start_col": 0
  }
}
