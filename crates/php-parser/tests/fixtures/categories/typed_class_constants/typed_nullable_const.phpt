===config===
min_php=8.3
===source===
<?php class A { const ?string N = null; }
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
                  "name": "N",
                  "visibility": null,
                  "is_final": false,
                  "type_hint": {
                    "kind": {
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 23,
                              "end": 29
                            }
                          }
                        },
                        "span": {
                          "start": 23,
                          "end": 29
                        }
                      }
                    },
                    "span": {
                      "start": 22,
                      "end": 29
                    }
                  },
                  "value": {
                    "kind": "Null",
                    "span": {
                      "start": 34,
                      "end": 38
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 39
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}
