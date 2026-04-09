===config===
min_php=8.1
===source===
<?php enum Suit { #[Description('Hearts')] case Hearts; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Suit",
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": "Hearts",
                  "value": null,
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Description"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 20,
                          "end": 31,
                          "start_line": 1,
                          "start_col": 20
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "value": {
                            "kind": {
                              "String": "Hearts"
                            },
                            "span": {
                              "start": 32,
                              "end": 40,
                              "start_line": 1,
                              "start_col": 32
                            }
                          },
                          "unpack": false,
                          "by_ref": false,
                          "span": {
                            "start": 32,
                            "end": 40,
                            "start_line": 1,
                            "start_col": 32
                          }
                        }
                      ],
                      "span": {
                        "start": 20,
                        "end": 41,
                        "start_line": 1,
                        "start_col": 20
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 43,
                "end": 56,
                "start_line": 1,
                "start_col": 43
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 57,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 57,
    "start_line": 1,
    "start_col": 0
  }
}
