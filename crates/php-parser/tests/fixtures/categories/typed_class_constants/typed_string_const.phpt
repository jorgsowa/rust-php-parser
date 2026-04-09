===config===
min_php=8.3
===source===
<?php class A { private const string Y = 'a'; }
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
                  "name": "Y",
                  "visibility": "Private",
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 30,
                          "end": 36,
                          "start_line": 1,
                          "start_col": 30
                        }
                      }
                    },
                    "span": {
                      "start": 30,
                      "end": 36,
                      "start_line": 1,
                      "start_col": 30
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "a"
                    },
                    "span": {
                      "start": 41,
                      "end": 44,
                      "start_line": 1,
                      "start_col": 41
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 46,
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
        "end": 47,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47,
    "start_line": 1,
    "start_col": 0
  }
}
