===source===
<?php class C { use A, B { A::m insteadof B; B::n as public nAlias; } }
===ast===
{
  "stmts": [
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
                        "start": 20,
                        "end": 21,
                        "start_line": 1,
                        "start_col": 20
                      }
                    },
                    {
                      "parts": [
                        "B"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 23,
                        "end": 25,
                        "start_line": 1,
                        "start_col": 23
                      }
                    }
                  ],
                  "adaptations": [
                    {
                      "kind": {
                        "Precedence": {
                          "trait_name": {
                            "parts": [
                              "A"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 27,
                              "end": 28,
                              "start_line": 1,
                              "start_col": 27
                            }
                          },
                          "method": "m",
                          "insteadof": [
                            {
                              "parts": [
                                "B"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 42,
                                "end": 43,
                                "start_line": 1,
                                "start_col": 42
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 27,
                        "end": 45,
                        "start_line": 1,
                        "start_col": 27
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
                              "start": 45,
                              "end": 46,
                              "start_line": 1,
                              "start_col": 45
                            }
                          },
                          "method": "n",
                          "new_modifier": "Public",
                          "new_name": "nAlias"
                        }
                      },
                      "span": {
                        "start": 45,
                        "end": 68,
                        "start_line": 1,
                        "start_col": 45
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
                "end": 70,
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
        "end": 71,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 71,
    "start_line": 1,
    "start_col": 0
  }
}
