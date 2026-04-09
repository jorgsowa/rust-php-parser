===config===
min_php=8.3
===source===
<?php class A { const int|string Z = 1; }
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
                "ClassConst": {
                  "name": "Z",
                  "visibility": null,
                  "type_hint": {
                    "kind": {
                      "Union": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "int"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 22,
                                "end": 25,
                                "start_line": 1,
                                "start_col": 22
                              }
                            }
                          },
                          "span": {
                            "start": 22,
                            "end": 25,
                            "start_line": 1,
                            "start_col": 22
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "string"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 26,
                                "end": 32,
                                "start_line": 1,
                                "start_col": 26
                              }
                            }
                          },
                          "span": {
                            "start": 26,
                            "end": 32,
                            "start_line": 1,
                            "start_col": 26
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 22,
                      "end": 32,
                      "start_line": 1,
                      "start_col": 22
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 37,
                      "end": 38,
                      "start_line": 1,
                      "start_col": 37
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 40,
                "start_line": 1,
                "start_col": 16
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 41,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41,
    "start_line": 1,
    "start_col": 0
  }
}
