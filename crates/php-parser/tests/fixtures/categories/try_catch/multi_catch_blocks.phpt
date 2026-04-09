===source===
<?php try { foo(); } catch (A $a) { } catch (B $b) { } catch (C $c) { }
===ast===
{
  "stmts": [
    {
      "kind": {
        "TryCatch": {
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Identifier": "foo"
                        },
                        "span": {
                          "start": 12,
                          "end": 15,
                          "start_line": 1,
                          "start_col": 12
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 12,
                    "end": 17,
                    "start_line": 1,
                    "start_col": 12
                  }
                }
              },
              "span": {
                "start": 12,
                "end": 19,
                "start_line": 1,
                "start_col": 12
              }
            }
          ],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "A"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 28,
                    "end": 30,
                    "start_line": 1,
                    "start_col": 28
                  }
                }
              ],
              "var": "a",
              "body": [],
              "span": {
                "start": 27,
                "end": 38,
                "start_line": 1,
                "start_col": 27
              }
            },
            {
              "types": [
                {
                  "parts": [
                    "B"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 45,
                    "end": 47,
                    "start_line": 1,
                    "start_col": 45
                  }
                }
              ],
              "var": "b",
              "body": [],
              "span": {
                "start": 44,
                "end": 55,
                "start_line": 1,
                "start_col": 44
              }
            },
            {
              "types": [
                {
                  "parts": [
                    "C"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 62,
                    "end": 64,
                    "start_line": 1,
                    "start_col": 62
                  }
                }
              ],
              "var": "c",
              "body": [],
              "span": {
                "start": 61,
                "end": 71,
                "start_line": 1,
                "start_col": 61
              }
            }
          ],
          "finally": null
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
