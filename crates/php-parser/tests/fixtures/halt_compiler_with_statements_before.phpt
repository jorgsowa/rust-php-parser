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
              "end": 19
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 21
      }
    },
    {
      "kind": {
        "HaltCompiler": "raw data here"
      },
      "span": {
        "start": 21,
        "end": 53
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 53
  }
}
