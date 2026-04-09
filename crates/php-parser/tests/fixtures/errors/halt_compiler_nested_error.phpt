===source===
<?php if (true) { __halt_compiler(); }
===errors===
__halt_compiler() can only be used at the outermost scope
unclosed ''}'' opened at 1:16
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Bool": true
            },
            "span": {
              "start": 10,
              "end": 14,
              "start_line": 1,
              "start_col": 10
            }
          },
          "then_branch": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "HaltCompiler": "}"
                  },
                  "span": {
                    "start": 18,
                    "end": 38,
                    "start_line": 1,
                    "start_col": 18
                  }
                }
              ]
            },
            "span": {
              "start": 16,
              "end": 38,
              "start_line": 1,
              "start_col": 16
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 38,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38,
    "start_line": 1,
    "start_col": 0
  }
}
