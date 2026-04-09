===source===
<?php echo 'before'; __halt_compiler(); raw data here
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "String": "before"
            },
            "span": {
              "start": 11,
              "end": 19,
              "start_line": 1,
              "start_col": 11
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 21,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "HaltCompiler": "raw data here"
      },
      "span": {
        "start": 21,
        "end": 53,
        "start_line": 1,
        "start_col": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 53,
    "start_line": 1,
    "start_col": 0
  }
}
